<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\UserResetPasswordToken;
use CodeIgniter\I18n\Time;

class Auth extends BaseController
{
    public function logout(): \CodeIgniter\HTTP\RedirectResponse
    {
        session()->destroy();

        return redirect()->to( base_url('login') );
    }

    public function get_login(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if( isLoggedIn() )
            return redirect()->to( base_url() );

        return view('auth/login');
    }

    public function login(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->validate([
            'email' => [
                'rules' => "required|valid_email|is_not_unique[user.email]",
                'errors' => [
                    'required' => 'Proszę podać adres e-mail',
                    'valid_email' => 'Proszę wprowadzić poprawny adres e-mail',
                    'is_not_unique' => 'Konto o podanym adresie e-mail nie istnieje'
                ]
            ],
            'password'  => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Proszę podać hasło.'
                ]
            ],
        ])) :
            return redirect()->to( base_url('login') )
                ->withInput()
                ->with('notification_errors', $this->validator->getErrors());
        endif;

        $data = $this->request->getPost();

        $user = ( new User)->where([
            'email'         => $data['email'],
            'status'        => 'Aktywny',
//            'deleted_at'    => NULL
        ])->first();

        if( !$user )
            return redirect()->to( base_url('login') )
                ->withInput()
                ->with('notification_errors', ['email' => 'Konto o podanym adresie nie istnieje']);


        if ( !password_verify( $data['password'], $user['password'] ) ) :
            return redirect()->to(base_url('login'))
                ->withInput()
                ->with('notification_errors', ['password' => 'Podane hasło jest niepoprawne']);
        endif;


        session()->setTempdata('user', [
            'id'            => $user['id'],
            'email'         => $data['email'],
            'rank'          => $user['rank']
        ], isset($data['remember']) && $data['remember'] == 1 ? SESSION_LONG : SESSION_SHORT);

        return redirect()->to( base_url() );
    }

    public function get_remind_password(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        return view('auth/remind_password');
    }

    public function remind_password(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->validate([
            'email' => [
                'rules' => "required|valid_email",
                'errors' => [
                    'required' => 'Proszę podać adres e-mail',
                    'valid_email' => 'Proszę wprowadzić poprawny adres e-mail'
                ]
            ]
        ])) :
            return redirect()->to( base_url('remind_password') )
                ->withInput()
                ->with('notification_errors', $this->validator->getErrors() );
        endif;

        $this->send_password_reset_email( $this->request->getPost('email') );

        return redirect()->to( base_url('remind_password') )
            ->with('notification_success', ['notification' => 'Na podany adres e-mail wyślemy link do ustawienia nowego hasła.']);
    }

    private function send_password_reset_email( $email )
    {
        $user = ( new User)->select('id')->where([
            'email'         => $email,
            'status'        => 'Aktywny',
//            'deleted_at'    => NULL
        ])->first();

        if( empty( $user['id'] ) )
            return;

        $tokenModel = new UserResetPasswordToken();

        $tokenModel->where([
            'id_user'   => $user['id']
        ])->update( null, [ 'used' => 1 ]);

        helper('text');
        $token = random_string(len: 32);

        $tokenModel->insert([
            'id_user'   => $user['id'],
            'token'     => $token
        ]);


        helper('email');
        $reset_url = base_url('set_new_password') . '?token=' . $token;
        ( new \Benefitshop_mailer() )->send_change_password_link( $email, $reset_url );
    }

    public function get_set_new_password(): string
    {
        if( empty( $token = $this->request->getGet('token') ) )
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $passTokenRow = ( new UserResetPasswordToken )->where([
            'used'              => 0,
            'token'             => $token
        ])->first();

        if( empty( $passTokenRow ) )
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $minutes_left = Time::now()->difference( Time::parse( $passTokenRow['expiration_date'] ) )->getMinutes();
        if( $minutes_left < 0 )
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $user = ( new User)->select('email')->where([
            'id'            => $passTokenRow['id_user'],
            'status'        => 'Aktywny',
//            'deleted_at'    => NULL
        ])->first();

        if( empty( $user['email'] ) )
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return view( 'auth/reset_password', [
            'token' => $token,
            'email' => $user['email']
        ]);
    }

    public function set_new_password(): \CodeIgniter\HTTP\RedirectResponse
    {
        $token = $this->request->getPost('token');
        if (!$this->validate(
            [
                'password_pass_new' => [
                    'rules' => 'required|min_length[8]|max_length[50]|regex_match[^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,50}$]',
                    'errors' => [
                        'required' => 'Proszę wypełnić to pole',
                        'min_length' => 'Podane hasło jest zbyt krótkie',
                        'max_length' => 'Podane hasło jest zbyt długie',
                        'regex_match' => 'Hasło musi zawierać conajmniej jedną dużą literę, jedną małą literę, jedną cyfrę oraz znak specjalny'
                    ]
                ],
                'password_pass_new_r' => [
                    'rules' => 'required|matches[password_pass_new]',
                    'errors' => [
                        'required' => 'Proszę wypełnić to pole',
                        'matches' => 'Podane hasła nie pasują do siebie'
                    ]
                ],
            ]
        ))
        {
            return redirect()->to( base_url('set_new_password') . '/?token=' . $token )
                ->with('notification_errors', $this->validator->getErrors());
        }

        $passTokenRow = ( new UserResetPasswordToken )->where([
            'used'              => 0,
            'token'             => $token
        ])->first();

        if( empty( $passTokenRow ) )
            return redirect()->to( base_url('remind_password') )
                ->with('notification_errors', ['notification' => 'Token wygasł. Proszę wygenerować nowy.']);

        $minutes_left = Time::now()->difference( Time::parse( $passTokenRow['expiration_date'] ) )->getMinutes();
        if( $minutes_left < 0 )
            return redirect()->to( base_url('remind_password') )
                ->with('notification_errors', ['notification' => 'Token wygasł. Proszę wygenerować nowy.']);

        ( new User)->update( $passTokenRow['id_user'], [
            'password'  => $this->request->getPost('password_pass_new')
        ]);

        ( new UserResetPasswordToken )->update( $passTokenRow['id'], [
            'used'  => 1
        ]);

        return redirect()->to( base_url('login') )
            ->with('notification_success', ['notification' => 'Hasło zostało zmienione.']);
    }

    public function change_password(): bool|string
    {
        if ( !$this->request->isAJAX() )
            return false;

        if ( !$this->validate([
            'current_password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Proszę podać swoje hasło do konta'
                ]
            ],
            'new_password'  => [
                'rules' => 'required|min_length[8]|max_length[50]|regex_match[^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,50}$]',
                'errors' => [
                        'required' => 'Proszę wypełnić to pole',
                        'min_length' => 'Podane hasło jest zbyt krótkie',
                        'max_length' => 'Podane hasło jest zbyt długie',
                        'regex_match' => 'Hasło musi zawierać conajmniej jedną dużą literę, jedną małą literę, jedną cyfrę oraz znak specjalny'
                ]
            ],
            'new_password_2'  => [
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'Proszę podać powtórzone hasło.',
                    'matches' => 'Podane hasła nie pasują do siebie'
                ]
            ],
        ]))
        {
            return json_encode([
                'error' => $this->validator->getErrors(),
            ]);
        }

        $data = $this->request->getPost();

        $user_model = new User();
        $user_data = $user_model->find( session()->user['id'] );

        if( !password_verify( $data['current_password'], $user_data['password']) ) :
            return json_encode([
                'error' => [
                    'current_password' => 'Błędne hasło do konta'
                ]
            ]);
        endif;

        $updated = $user_model->update( session()->user['idUser'], [
            'password' => $data['new_password']
        ]);

        return $updated
            ? json_encode([
                    'notification' => 'Zaktualizowano hasło'
                ])
            : json_encode([
                    'error' => true,
                    'notification' => "Nie udało się zaktualizować hasła, w przypadku dalszych problemów skontaktuj się z administratorem"
                ]);
    }
}

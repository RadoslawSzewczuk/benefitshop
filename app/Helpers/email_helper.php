<?php

Class Benefitshop_mailer {

    private \CodeIgniter\Email\Email $email_builder;

    public function __construct()
    {
        $this->email_builder = \Config\Services::email();
    }

    private function send_email( array $data ): void
    {
        $this->email_builder->setTo( $data['email'] );
        $this->email_builder->setSubject( $data['subject'] );
        $this->email_builder->setMessage( view( 'emails/' . $data['template'], $data) );

        $this->email_builder->send();
    }

    public function send_change_password_link( string $email, string $url ): void
    {
        $this->send_email([
            'email'     => $email,
            'template'  => 'password_change',
            'subject'   => 'Benefitshop - Zmiana hasła',
            'title'     => 'Zmiana hasła',
            'url'       => $url,
        ]);
    }
}
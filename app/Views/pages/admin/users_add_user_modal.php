<div id="addUserModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p class="modal-heading">Add user</p>
                <form id="addUserForm" data-action="">
                    <fieldset>
                        <div class="form-item">
                            <div class="form-item-group">
                                <input class="form-control" type="email" id="email" name="email" placeholder="E-mail">
                                <p class="form-error-box"></p>
                            </div>
                            <div class="form-item-group">
                                <input class="form-control" type="password" id="password" name="password" placeholder="Password">
                                <p class="form-error-box"></p>
                            </div>
                            <div class="form-item-group">
                                <select class="select-box-regular" id="rank" name="rank" placeholder="Rank" data-placeholder="Rank">

                                    <option value="<?= SECTOR_MANAGER_RANK_ID ?>">Sector manager</option>
                                    <option value="<?= REGION_MANAGER_RANK_ID ?>">Regional manager</option>
                                    <option value="<?= DISTRIBUTOR_RANK_ID ?>">Distributor</option>
                                    <option value="<?= ADMIN_RANK_ID ?>">Administrator</option>

                                </select>
                                <p class="form-error-box"></p>
                            </div>
                            <div class="form-item-group">
                                <input class="form-control" type="text" id="erp" name="erp" placeholder="ERP">
                                <p class="form-error-box"></p>
                            </div>
                            <div class="form-item-group">
                                <input class="form-control" type="text" id="company_name" name="company_name" placeholder="Company name">
                                <p class="form-error-box"></p>
                            </div>
                            <div class="form-item-group">
                                <select id="distributors" name="distributors"></select>
                                <p class="form-error-box"></p>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <div class="modal-footer-buttons-row">
                    <div class="modal-footer-button-col">
                        <button type="button" class="button-modal btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="modal-footer-button-col">
                        <button data-submit type="button" class="button-modal btn btn-success">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
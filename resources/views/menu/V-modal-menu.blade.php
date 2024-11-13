<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Do you want to continue?</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-loading" data-loading-text="Loading">Yes</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="formModal-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modalForm-1" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <x-input type="text" name="first_menu_name" label="First Menu Name" placeholder="Enter First Menu Name" />
                    </div>
                    <div class="mb-3">
                        <x-input type="text" name="first_menu_link" label="First Menu Link" placeholder="Enter First Menu Link" />
                    </div>
                    <div class="mb-3">
                        <x-input type="text" name="first_menu_icon" label="First Menu Icon" placeholder="Enter First Menu Icon" />
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary btn-loading btn-submit" data-loading-text="Loading"></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="formModal-2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="modalForm-2" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <x-select name="first_menu_id" label="First Menu Name" :options="$menu_first_list" />
                    </div>
                    <div class="mb-3">
                        <x-input type="text" name="second_menu_name" label="Second Menu Name" placeholder="Enter Second Menu Name" />
                    </div>
                    <div class="mb-3">
                        <x-input type="text" name="second_menu_link" label="Second Menu Link" placeholder="Enter Second Menu Link" />
                    </div>
                    <div class="mb-3">
                        <x-input type="text" name="second_menu_icon" label="Second Menu Icon" placeholder="Enter Second Menu Icon" />
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary btn-loading btn-submit" data-loading-text="Loading"></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

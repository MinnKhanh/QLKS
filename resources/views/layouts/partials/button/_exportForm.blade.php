<div wire:ignore class="modal fade" id="modal-form-export" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xác nhận </h5>
            </div>
            <div class="modal-body">
                Bạn có muốn xuất file không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-basic" id="close-modal-delete" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" wire:click.prevent="export()">Đồng ý</button>
            </div>
        </div>
    </div>
</div>

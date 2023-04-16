
{{--@if(checkRole($model."-delete"))--}}
<div wire:ignore class="modal fade" id="modal-form-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
            </div>
            <div class="modal-body">
                Bạn có muốn xóa không? Thao tác này không thể phục hồi!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="close-modal-delete" data-dismiss="modal">Không</button>
                <button type="button" class="btn btn-danger" wire:click.prevent="delete()">Xóa bỏ</button>
            </div>
        </div>
    </div>
</div>
{{--@endif--}}

<div wire:ignore.self class="modal fade" id="modal-form-import-cnbh" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import chứng nhận bảo hành</h5>
            </div>
            <div class="modal-body">
                <h5>Chọn file để import</h5>
                <div class="mt-3">
                    <input type="file" class="form-control" wire:model.defer="fileCNBH">
                    @error('fileCNBH')
                            @include('layouts.partials.text._error')
                    @enderror
                </div>
                <div class="mt-5">
                    <a class="text-primary" wire:click="downloadExampleCNBH_Xe()"><u>Tải file mẫu tại đây !</u></a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close-modal-import"
                    data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" wire:click.prevent="importCNBH()">Đồng ý</button>
            </div>
        </div>
    </div>
</div>

<script>
    window.livewire.on('close-modal-import-cnbh', () => {
        document.getElementById('modal-form-import-cnbh').click();
    });
</script>

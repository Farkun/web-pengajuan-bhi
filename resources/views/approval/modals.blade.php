<!-- Modal Tolak -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Tolak Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="rejecttForm" onsubmit="submitForm(event, 'rejecttForm', 'Tolak');">
                    @csrf
                    <input type="hidden" name="pengaju_id" id="rejectId">
                    <input type="hidden" name="status" value="Tolak">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}"> <!-- ID pengguna yang sedang login -->
                    <div class="form-group">
                        <label for="keterangan">Catatan:</label>
                        <textarea class="form-control" id="rejectKeterangan" name="keterangan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pending -->
<div class="modal fade" id="pendingModal" tabindex="-1" role="dialog" aria-labelledby="pendingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pendingModalLabel">Tunda Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="pendingForm" onsubmit="submitForm(event, 'pendingForm', 'Pending');">
                    @csrf
                    <input type="hidden" name="pengaju_id" id="pendingId">
                    <input type="hidden" name="status" value="Pending">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}"> <!-- ID pengguna yang sedang login -->
                    <div class="form-group">
                        <label for="keterangan">Catatan:</label>
                        <textarea class="form-control" id="pendingKeterangan" name="keterangan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>
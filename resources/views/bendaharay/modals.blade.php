<!-- Modal -->
<div class="modal fade" id="rejecttModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejecttModalLabel">Tolak Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rejectForm" method="POST">
                    @csrf
                    <input type="hidden" id="rejectId" name="pengaju_id">
                    <input type="hidden" name="status" value="Tolak">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}"> <!-- ID pengguna yang sedang login -->
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" onclick="rejectForm">Tolak Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="defaultpassword" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Attention</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You just logged in using the default password. Kindly proceed to change your password first.</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-dark" href="<?= site_url('changepassword') ?>" class="btn btn-dark">Change my password</a>
            </div>
        </div>
    </div>
</div>
<div id="profileComplete" class="modal fade card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Attention</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>We have detected that you have not completed your profile. Please proceed to complete your profile first before using the system.</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-dark" href="<?= site_url('profile/update') ?>" class="btn btn-dark">Complete my profile</a>
            </div>
        </div>
    </div>
</div>
</div>
<br>
<footer id="footer" class="footer">
    <div class="container">
        <span class="text-muted">Developed by <a href="https://github.com/njbsb">njbsb</a>.</span>
        <!-- <p>Developed by <a href="https://github.com/njbsb">njbsb</a>.</p> -->
    </div>
</footer>
<script type="text/javascript">
    var loggedin = <?= json_encode($this->session->userdata('logged_in')) ?>;
    var defaultpassword = <?= json_encode($this->session->userdata('defaultpassword')) ?>;
    var profileComplete = <?= json_encode($this->session->userdata('profilecomplete')) ?>;
    if (loggedin) {
        if (defaultpassword) {
            $("#defaultpassword").modal()
        }
        if (!profileComplete) {
            $("#profileComplete").modal()
        }
    }
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>

</html>
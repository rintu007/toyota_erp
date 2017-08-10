<div class="push"></div>
</div>
<div id="footer">
    <div id="footer-content">Powered by: <a href="#">Synageglobal.com</a></div>
</div>

<script>
    $(document).ready(function(e) {
        customscroll();
        $("#btn-pbo").click(function() {
            $(".pbo-form").fadeIn(1000);
        });
        $(document.body).on('click', ".form-error", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-type", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-updatetype", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-updatestaff", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-staff", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-condition", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-updatecondition", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-period", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-updateperiod", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-jrm", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-updatejrm", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-foreman", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-allbrands", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-uallbrands", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-allmodels", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-uallmodels", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-reportJob", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-make", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-qi", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-serviceadv", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-serviceadvb", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-surveyor", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-inscompany", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-paintername", function() {
            $(this).hide();
        });
        $(document.body).on('click', ".error-dentername", function() {
            $(this).hide();
        });
    });
    $(function() {
        $(".date").datepicker({
            showOn: "button",
            buttonImage: '<?= base_url(); ?>assets/images/date.png',
            buttonImageOnly: true,
            showButtonPanel: true,
            dateFormat: "dd-M-yy"
        });
    });
</script>
<script>
    function formhide() {
        $(".close-pop").trigger('click');
    }
    function popupbox(div_id, elem) {
        $('.popup-' + div_id).bPopup({
            fadeSpeed: 'slow', //can be a string ('slow'/'fast') or int
            followSpeed: 1500, //can be a string ('slow'/'fast') or int
            modalColor: '#333',
            closeClass: 'close-pop'
        }, function() {
            var value = elem.parentElement.parentElement.childNodes[1].innerHTML;
            $(this).find("#idResourceBook").val(value);
        });

    }
    ///************************/
    function customscroll() {
        $('.scrollbox').enscroll({
            // a configuration property
            showOnHover: false,
            // another configuration property
            verticalScrolling: true,
            pollChanges: true
                    // ... more configuration properties ...
        });
    }
</script>
<script>
    $.validate({
        modules: 'location, date, security, file',
        onModulesLoaded: function() {
            $('#country').suggestCountry();
        }
    });
</script>
</body>
</html>
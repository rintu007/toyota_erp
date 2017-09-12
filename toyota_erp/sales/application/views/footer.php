<div class="push"></div>
</div>
<!--<div id="footer">
    <div id="footer-content">Powered by: <a href="#">Synageglobal.com</a></div>
</div>-->

<script>
    $(document).ready(function(e) {
        customscroll();
//        $(".datagrid td[name=resId]").click(function(e) {
//            $(".pbo-form").fadeIn(1000);
//            $("#idRb").val(e.target.innerHTML);
//        });
        $("#btn-pbo").click(function() {
            $(".pbo-form").fadeIn(1000);
        });
        $(document.body).on('click', ".form-error", function() {
            $(this).hide();
        });
    });
    $(function() {
        $(".date").datepicker({
            showOn: "button",
            buttonImage: '<?= base_url(); ?>assets/images/date.png',
            buttonImageOnly: true,
            showButtonPanel: true,
            dateFormat: "yy-mm-dd"
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
    /*   Commented on 31-March-2015 */
//    (function() {
//        var elem = document.getElementById('custom-file-input'),
//                input = elem.getElementsByTagName('input')[0],
//                showPath = elem.getElementsByTagName('span')[0];
//        input.onchange = function() {
//            showPath.textContent = this.value;
//            this.title = this.value;
//        };
//    })();
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
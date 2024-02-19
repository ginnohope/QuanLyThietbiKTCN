<script src="/temp/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/temp/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/temp/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/temp/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/temp/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/temp/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/temp/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/temp/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/temp/plugins/moment/moment.min.js"></script>
<script src="/temp/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/temp/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/temp/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/temp/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/temp/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/temp/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/temp/dist/js/pages/dashboard.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>   

<script>
  $(document).ready(function () {
    $(".title").on("keyup", function () {
        const titleValue = $(this).val();
        const slugElement = $(".slug");
        slugElement.val(ChangeToSlug(titleValue));
    });

    $(".slug").on("change", function () {
        if ($(this).val() === "") {
            const titleValue = $(".title").val();
            $(this).val(ChangeToSlug(titleValue));
        }
    });
});

function ChangeToSlug(title) {
    let slug = title.toLowerCase();

    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, "a");
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, "e");
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, "i");
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, "o");
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, "u");
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, "y");
    slug = slug.replace(/đ/gi, "d");
    slug = slug.replace(
        /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
        ""
    );
    slug = slug.replace(/ /gi, "-");
    slug = slug.replace(/\-\-\-\-\-/gi, "-");
    slug = slug.replace(/\-\-\-\-/gi, "-");
    slug = slug.replace(/\-\-\-/gi, "-");
    slug = slug.replace(/\-\-/gi, "-");
    slug = "@" + slug + "@";
    slug = slug.replace(/\@\-|\-\@|\@/gi, "");

    return slug;
}
</script>

@if (Session::has('message'))
    <script>
        toastr.options = {
            "progressBar" : true,
            "closeButton" : true,
        }
        toastr.success("{{ Session::get('message') }}");
    </script>
@endif

<script>
    $(document).ready(function() {
      var currentUrl = window.location.href;
      $('.nav-item a').each(function() {
        var linkUrl = $(this).attr('href');
        if (linkUrl === currentUrl) {
          $('.nav-item').removeClass('menu-open');
          $('.nav-link').removeClass('active');
            var parent = $(this).closest('.nav-item.menu-close');
            parent2 = parent.find('.nav-link__parent');
            parent2.addClass('active');
          $(this).closest('.nav-link').addClass('active');
          $(this).closest('.menu-close').addClass('menu-open');
        }
      });
    });
  </script>


<script>
  $(document).ready(function () {
      $(".user_profile_dd").on("click", function () {
          $(this).find('.dropdown-menu').toggle();
      });

      $(document).on("click", function (event) {
          var $trigger = $(".user_profile_dd");
          if ($trigger !== event.target && !$trigger.has(event.target).length) {
              $(".dropdown-menu").hide();
          }
      });
  });
</script>
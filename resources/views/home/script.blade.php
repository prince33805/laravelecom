<div class="cpy_">
    <p class="mx-auto">© 2021 All Rights Reserved By <a href="#">xibho007</a><br>

        Distributed By <a href="#" target="_blank">xibho007</a>

    </p>
</div>
<!-- jQery -->
<script src="home/js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="home/js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="home/js/bootstrap.js"></script>
<!-- custom js -->
<script src="home/js/custom.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
    $('.delete-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure to remove this product ?',
            icon: 'warning',
            buttons: {
                danger: {
                    text: 'Yes',
                },
                cancel: 'Cancel'
            },
            // buttons: ["Cancel", "Yes!"]
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });

    $("#preloader").animate({
            'opacity': '0'
        }, 600, function(){
            setTimeout(function(){
                $("#preloader").css("visibility", "hidden").fadeOut();
            }, 300);
        });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#search_text').keyup(function() {
            var query = $(this).val();
            //   console.log(query);
            if (query != '') {
                var _token = $('input[name="_token"]').val();
            }
            $.ajax({
                url: "{{ route('searchproduct') }}",
                method: "POST",
                data: {
                    query: query,
                    _token: _token
                },
                success: function(data) {
                    $('#list').fadeIn();
                    $('#list').html(data);
                }
            });
        });
    });
    $(document).on('click', 'li', function() {
        $('#list').fadeOut();
        // $('#search_text').val($(this).text());
    })
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
    integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
</script>

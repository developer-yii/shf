$(document).ready(function(){
    setInterval(function () {
            getNotification();
        }, 15 * 1000);

    function getNotification() {
        if ($('#notification-hifi').length > 0) {
            $.ajax({
                url: getNotificationUrl,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#sidebar-menu').find('.badge').addClass('d-none');
                    $('.notification-listing').html('');
                    $('#notification-hifi').find('.notification-main-icon.bx-tada').removeClass(
                        'bx-tada');
                    $('#notification-hifi').find('.notification-count').text('0');
                    var html = '';
                    if (response.status && response.data.length > 0) {
                        if (!$('#notification-hifi').find('.notification-main-icon').hasClass('bx-tada')) {
                            $('#notification-hifi').find('.notification-main-icon').addClass(
                                'bx-tada');
                        }
                        $('#notification-hifi').find('.notification-count').text(response.data.length);
                        $.each(response.data, function (key, value) {
                            html +=
                                '<a href="' + value.url + '" class="text-reset notification-item">' +
                                '<div class="d-flex">' +
                                '<div class="avatar-xs me-3">' +
                                '<span class="avatar-title bg-primary rounded-circle font-size-16">' +
                                '<i class="' + value.icon + '"></i>' +
                                '</span>' +
                                '</div>' +
                                '<div class="flex-grow-1">' +
                                '<h6 class="mb-1">' + value.title + '</h6>' +
                                '<div class="font-size-12 text-muted">' +
                                '<p class="mb-1">' + value.body + '</p>' +
                                '<p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>' +
                                value.time + '</span></p>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</a>';

                            if (value.type == 'appointment') {
                                if ($('.appointment-badge').hasClass('d-none')) {
                                    $('.appointment-badge').removeClass('d-none')
                                }
                            }

                            if (value.type == 'purchaseEnquiry') {
                                if ($('.purchase-enquiry-badge').hasClass('d-none')) {
                                    $('.purchase-enquiry-badge').removeClass('d-none')
                                }
                            }

                            if (value.type == 'order') {
                                if ($('.order-badge').hasClass('d-none')) {
                                    $('.order-badge').removeClass('d-none')
                                }
                            }

                            if (value.type == 'calendar') {
                                if ($('.calendar-badge').hasClass('d-none')) {
                                    $('.calendar-badge').removeClass('d-none')
                                }
                            }
                        })
                    } else {
                        html += '<div class="notice-empty alert alert-warning d-block mb-2 me-3 ms-3" role="alert" style="display: none;"><i class="mdi mdi-alert-outline me-2"></i>' + No_new_notifications + '</div>';
                    }
                    $('.notification-listing').html(html);

                },
                error: function (error) {
                    showMessage("error", something_went_wrong);
                }
            });
        } else {
            $('#sidebar-menu').find('.badge').remove();
        }
    }

});
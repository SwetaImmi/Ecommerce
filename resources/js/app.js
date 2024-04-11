
import './bootstrap';

var notificationsWrapper = $('.dropdown-notifications');
var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
var notificationsCountElem = notificationsToggle.find('i[data-count]');
var notificationsCount = parseInt(notificationsCountElem.data('count'));
var notifications = notificationsWrapper.find('ul.dropdown-menu');

if (notificationsCount <= 0) {
    notificationsWrapper.hide();
}

$(document).ready(function () {
    $(document).on('click', '#send_message', function (e) {
        e.preventDefault();

        let username = $('#username').val();
        let message = $('#message').val();
        if (username == '' || message == '') {
            alert('Please enter both username and message')
            return false;
        }

        $.ajax({
            method: 'post',
            url: '/send_notification',
            data: { username: username, message: message },
            success: function (data) {
                $('#notification_count').val()
                $('#notification_count').text(parseInt($('#notification_count').text()) + 1);
                $('#message').val('');



                var existingNotifications = notifications.html();
                console.log(data)
                // console.log(existingNotifications)
                var newNotificationHtml = `
          <li class="notification active">
              <div class="media">
                <div class="media-left">
                  <div class="media-object">
                    <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2250%22%20height%3D%2250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2050%2050%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1854e547215%20text%20%7B%20fill%3A%23919191%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1854e547215%22%3E%3Crect%20width%3D%2250%22%20height%3D%2250%22%20fill%3D%22%23cccccc%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%226.46875%22%20y%3D%2229.55999994277954%22%3E50x50%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                  </div>
                </div>
                <div class="media-body">
                  <strong class="notification-title">` + data.msg + `</strong>
                  <!--p class="notification-desc">Extra description can go here</p-->
                  <div class="notification-meta">
                    <small class="timestamp">about a minute ago</small>
                  </div>
                </div>
              </div>
          </li>
        `;
                notifications.html(newNotificationHtml + existingNotifications);

                notificationsCount += 1;
                notificationsCountElem.attr('data-count', notificationsCount);
                notificationsWrapper.find('.notif-count').text(notificationsCount);
                notificationsWrapper.show();
            }
        });

    });
});

console.log(window.Echo.channel('notification'))

window.Echo.channel('notification')
    .listen('.PostLiked',(e)=>{
      alert("testing");

        $('#message').val('');
    });



    
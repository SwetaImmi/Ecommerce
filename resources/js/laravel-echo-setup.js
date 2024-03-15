import Echo from 'laravel-echo';
   
window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ":" + window.laravel_echo_port
});

mix.js('resources/assets/js/laravel-echo-setup.js', 'public/js');
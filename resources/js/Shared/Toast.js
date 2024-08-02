import Swal from 'sweetalert2'

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    iconColor: 'white',
    customClass: {
      popup: 'colored-toast',
    },
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
});

export default Toast;

export const ToastSuccess = (message = 'Success') => {
    Toast.fire({
        icon: 'success',
        title: message,
    });
}
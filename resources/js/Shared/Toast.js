import Swal from 'sweetalert2'

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    iconColor: 'white',
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    },
    customClass: {
      popup: 'colored-toast',
    },
    showConfirmButton: true,
    timer: 3000,
    timerProgressBar: true,
});

const ToastSuccess = (message = 'Success') => {
    Toast.fire({
        icon: 'success',
        title: message,
    });
}
const ToastError = (message = 'Error') => {
    Toast.fire({
        icon: 'error',
        title: message,
    });
}
const ToastWarning = (message = 'Warning') => {
    Toast.fire({
        icon: 'warning',
        title: message,
    });
}
const ToastInfo = (message = 'Info') => {
    Toast.fire({
        icon: 'info',
        title: message,
    });
}
const ToastQuestion = (message = 'Question') => {
    Toast.fire({
        icon: 'question',
        title: message,
    });
};

export default Toast;
export {
    Toast,
    ToastSuccess,
    ToastError,
    ToastWarning,
    ToastInfo,
    ToastQuestion,
}
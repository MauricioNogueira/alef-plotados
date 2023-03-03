import iziToast from "izitoast";

const ToastShow = (configuration) => {
    iziToast.show(configuration)
}

const ToastQuestion = (configuration) => {
    iziToast.question(configuration)
}

export { ToastShow, ToastQuestion };
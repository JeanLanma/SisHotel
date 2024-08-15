const GetToday = (format = 'dd-mm-yyyy') => {
    const today = new Date();
    const day = String(today.getDate()).padStart(2, '0');
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    const year = today.getFullYear();

    return format.replace('dd', day).replace('mm', month).replace('yyyy', year);
};

export {
    GetToday,
}
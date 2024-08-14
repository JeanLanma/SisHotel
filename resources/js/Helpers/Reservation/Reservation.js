//# String formats

// Dates
const FormatDate = (date) => {
    const d = new Date(date);
    const year = d.getFullYear();
    const month = (d.getMonth() + 1).toString().padStart(2, '0');
    const day = d.getDate().toString().padStart(2, '0');
    return `${year}-${month}-${day}`;
};
// Prices

/**
 * 
 * @param {*} price number | string to format
 * @returns string like $1,000.00
 */
const FormatCurrency = (price) => {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    }).format(price);
};
//# Calculations
const GetNights = (checkIn, checkOut) => {
    const checkInDate = new Date(checkIn);
    const checkOutDate = new Date(checkOut);
    const timeDifference = checkOutDate.getTime() - checkInDate.getTime();
    const nights = timeDifference / (1000 * 3600 * 24);
    return nights;
};

const GetTotalPrice = (price, nights, rooms) => {
    return (price * nights) * rooms;
};

const ApplyTax = (price, tax = .19) => {
    return price + (price * tax);
}

export {
    GetNights,
    GetTotalPrice,
    ApplyTax,
    FormatDate,
    FormatCurrency,
};
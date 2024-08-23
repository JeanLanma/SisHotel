//# String formats

// Pluralize a word
const Pluralize = (word, count) => {
    const dictionary = {
        'habitación': 'habitaciones',
        'habitacion': 'habitaciones',
        'adulto': 'adultos',
        'niño': 'niños',
    };

    return count > 1 ? `${word}s` : word;
};

// Dates
const FormatDate = (date) => {
    const d = new Date(date);
    const year = d.getFullYear();
    const month = (d.getMonth() + 1).toString().padStart(2, '0');
    const day = d.getDate().toString().padStart(2, '0');
    return `${year}-${month}-${day}`;
};

/**
 * Format a date to human readable format like "Viernes, 16 de Agosto de 2024"
 * @param {*} date 
 * @returns string
 */
const FormatDateToHuman = (date) => {
    const d = new Date(date);
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateStr = d.toLocaleDateString('es-MX', options);
    return dateStr.charAt(0).toUpperCase() + dateStr.slice(1);
};
/**
 * Format a date to human readable format like "16 de Agosto, 2024"
 * @param {*} date 
 * @returns string
 */
const FormatToDateHumanShort = (date) => {
    const d = new Date(date);
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const dateStr = d.toLocaleDateString('es-MX', options);
    return dateStr.charAt(0).toUpperCase() + dateStr.slice(1);
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
const IsCheckInToday = (checkIn) => {
    const checkInDate = new Date(checkIn);
    const today = new Date();
    return checkInDate.getDate() === today.getDate();
};
const IsCheckOutToday = (checkOut) => {
    const checkOutDate = new Date(checkOut);
    const today = new Date();
    return checkOutDate.getDate() === today.getDate();
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
    FormatDateToHuman,
    FormatToDateHumanShort,
    FormatCurrency,
    IsCheckInToday,
    IsCheckOutToday,
    Pluralize
};
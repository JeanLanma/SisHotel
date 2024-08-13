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
};
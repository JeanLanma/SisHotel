const RoomStatusColor = (status) => {
    const colors = {
        'available': 'bg-green-200',
        'unavailable': 'bg-red-200',
        'maintenance': 'bg-yellow-100',
    }
    return colors[status] ?? 'bg-white text-gray-500';
};
const RoomStatusLabel = (status) => {
    const colors = {
        'available': 'Disponible',
        'unavailable': 'No disponible',
        'maintenance': 'Mantenimiento',
    }
    return colors[status] ?? 'Desconocido';
}
export {
    RoomStatusColor,
    RoomStatusLabel
};
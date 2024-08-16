const today = (new Date()).toISOString().split('T')[0];
const tomorrow = (new Date(Date.now() + 86400000)).toISOString().split('T')[0];
/** V1.0.1-16082024 */
const ReservationData = {
    "id": null,
    "serie":  "A",
    "folio": null,
    "guests_name": "",
    "checkin": today,
    "checkout": tomorrow,
    "arrival_time": "15:00",
    "status": "pending",
    "expiration_date": today,
    "adults": 2,
    "kids": 0,
    "person_booking_name": "",
    "phone": "",
    "email": "",
    "observations": "",
    "reservation_type": null,
    "rooms": 1,
    "room_type_id": 1,
    "room_id": null,
    "user_id": null,
    "shift": null,
    "guests_id": null,
    "total": 0,
    "tax_free_account": 0,
    "mail_sent": 0,
    "internal_reference": null,
    "created_at": today,
    "updated_at": today,
    "room_type": {
        "id": 1,
        "name": "Suite sencilla",
        "room_type": "STS",
        "description": "Suite sencilla para dos personas",
        "base_occupancy": 2,
        "max_occupancy": 2,
        "base_occupancy_kids": 2,
        "max_occupancy_kids": null,
        "base_price": 1000,
        "extra_adult_price": null,
        "extra_kid_price": null,
        "base_availability": 3,
        "status": "ok",
        "created_at": "2024-08-15T20:28:32.000000Z",
        "updated_at": "2024-08-15T20:29:51.000000Z"
    },
    "guests": {
        "id": 5,
        "name": "Alan",
        "lastname": "Diaz",
        "phone": "33-2442-2442",
        "email": "alan@diaz.com",
        "created_at": "2024-08-16T18:08:09.000000Z",
        "full_name": "Alan Diaz "
    },
    "user": {
        "id": 1,
        "name": "admin",
        "email": "admin@admin.com",
        "profile_photo_url": "https://ui-avatars.com/api/?name=a&color=7F9CF5&background=EBF4FF"
    }
};

export {
    ReservationData
}
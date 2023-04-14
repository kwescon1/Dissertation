const STORAGE_KEY = 'USER';

export function store(data) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
}

export function deleteUser() {
    localStorage.removeItem(STORAGE_KEY);
}

export function getAuthUser(){
    let user = localStorage.getItem(STORAGE_KEY);

    return JSON.parse(user);
}
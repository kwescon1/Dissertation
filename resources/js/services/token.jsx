import CryptoJS from 'crypto-js';
import {getAuthUser} from './storage'

const TOKEN_KEY = "TOKEN_KEY";

export function encryptToken(token) {
  const encrypted = CryptoJS.AES.encrypt(token, TOKEN_KEY);
  return encrypted.toString();
}

function decryptToken(encryptedToken) {
  const decrypted = CryptoJS.AES.decrypt(encryptedToken, TOKEN_KEY);
  return decrypted.toString(CryptoJS.enc.Utf8);
}

export  function setHeader(isAuthenticated) {
    if (isAuthenticated) {
        const user = getAuthUser();

        const token = decryptToken(user?.token);

        return {
            Accept: "application/json",
            "Content-Type": "application/json",
            Authorization: "Bearer " + token,
        };
    } else {
        return {
            Accept: "application/json",
            "Content-Type": "application/json",
        };
    }
}
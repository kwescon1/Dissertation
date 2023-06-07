/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require("./layouts/Root");

window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

window.axios.defaults.baseURL = process.env.MIX_BASE_URL;
import "react-toastify/dist/ReactToastify.css";
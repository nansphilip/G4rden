import AsyncRouter from "/static/js/async-router.js";

export const getLastUser = async () => {
    try {
        return await AsyncRouter("/index.php?p=last-user");
    } catch (error) {
        console.error(error);
        return "error";
    }
}

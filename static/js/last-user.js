import AsyncRouter from "/static/js/async-router.js";

export const getLastUser = async () => {
    try {
        return await AsyncRouter.get("last-user");
    } catch (error) {
        return error;
    }
}

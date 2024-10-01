export default async function AsyncRouter(url) {
    try {
        // const response = await fetch(url);
        // const data = await response.json();
        // return data;
        return "ok";
    } catch (error) {
        console.error(error);
        return "error";
    }
}

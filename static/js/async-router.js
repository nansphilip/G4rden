export default class AsyncRouter {
    static async add(url, params = {}) {}

    static async get(url, params = {}) {
        try {
            // Fetch the data
            const response = await fetch(`/index.php?a=${url}`, {
                method: "POST",
                body: JSON.stringify(params),
            });

            // Parse the data
            const { status, message, data } = await response.json();

            // Throw an error if the server returns an error
            if (status === "error") {
                throw new Error(message);
            }

            // Return the data
            return { data };
        } catch (error) {
            return { error: `An error occured: ${error.message}` };
        }
    }

    static async update(url, params = {}) {}

    static async delete(url, params = {}) {}
}

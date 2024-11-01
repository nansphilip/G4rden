export default class AsyncRouter {
    static async post(url, params = {}) {
        try {
            // Send the data
            const response = await fetch(`/index.php?a=${url}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(params),
            });

            // Parse the response
            const { status, message, data } = await response.json();

            // Throw an error if the server returns an error
            if (status === "error") {
                throw new Error(message);
            }

            // Return the data
            return { data };
        } catch (error) {
            return { error: `An error occurred: ${error.message}` };
        }
    }

    static async get(url) {
        try {
            // Fetch the data
            const response = await fetch(`/index.php?a=${url}`, {
                method: "GET"
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
            return { error: `An error occurred: ${error.message}` };
        }
    }
}

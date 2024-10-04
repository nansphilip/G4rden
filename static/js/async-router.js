export default class AsyncRouter {

    static async add(file, data) {}

    static async get(file) {
        try {
            // Associative object of URLs
            const url = {
                "last-user": "index.php?a=last-user",
            };

            // Fetch the data
            const response = await fetch(url[file], {
                method: "POST",
                headers: { "Content-Type": "application/json" },
            });

            // if (!response.ok) {
            //     throw new Error("AsyncRouter -> " + response.status);
            // }

            // Parse the data
            const data = await response.json();

            // Return the data
            return data;
        } catch (error) {
            return error;
        }
    }

    static async update(file, data) {}

    static async delete(file, data) {}
}

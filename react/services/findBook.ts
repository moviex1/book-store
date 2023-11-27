export const findBooks = async (title: string) => {
    try {
        const response = await fetch(
            `http://localhost:8081/api/v1/book/title?title=${title}`
        )
        return response.json()
    } catch (error) {
        throw new Error("Cannot find book with such a value")
    }
}
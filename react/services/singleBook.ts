export const fetchSingleBook = async (id: string) => {
    try {
        const response = await fetch(`https://${process.env.BACKEND_URL}/api/v1/book/${id}`)
        return response.json()
    } catch {
        throw new Error("failed to fetch")
    }
}

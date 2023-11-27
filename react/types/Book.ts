import { Author } from "./Author"
import { Photos } from "./photos"
import { Tags } from "./tags"

export interface Book {
    id: number
    title: string
    authors: Author[]
    reviews: string[] | null
    releaseDate: string
    pages: number
    description: string
    tags: Tags[]
    photos: Photos[]
    price: string
}

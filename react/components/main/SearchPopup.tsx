"use client"
import { findBooks } from "@/services/findBook"
import React, { useState } from "react"
import { RxCross1 } from "react-icons/rx"
import FoundBooks from "./FoundBooks"
import { Book } from "@/types/Book"

//TODO: do something with 'use client'

type Props = {
    setIsOpen: React.Dispatch<React.SetStateAction<boolean>>
    inputValue: string
    setInputValue: React.Dispatch<React.SetStateAction<string>>
}

const SearchPopup = ({ setIsOpen, inputValue, setInputValue }: Props) => {
    const [books, setBooks] = useState<Book[]>()

    const closePopup = () => {
        setIsOpen(false)
    }

    const handleChange = async (e: React.ChangeEvent<HTMLInputElement>) => {
        setInputValue(e.target.value)
        setBooks(await findBooks(inputValue))
    }

    return (
        <div
            onClick={closePopup}
            className="w-full h-full absolute top-0 left-0 bg-[rgba(0,0,0,0.6)]"
        >
            <div
                onClick={(e) => e.stopPropagation()}
                className="bg-white overflow-scroll shadow-[0px_2px_20px_0px_rgba(0,0,0,0.4)] rounded-sm absolute w-[95%] h-[90%] -translate-y-1/2 -translate-x-1/2 top-1/2 left-1/2"
            >
                <div className="flex p-6 border-b-2 border-neutral-200">
                    <input
                        type="search"
                        onChange={handleChange}
                        className="w-full placeholder:text-[#0000004D] rounded-sm h-14 bg-neutral-100 pl-4"
                        value={inputValue}
                    />
                    <button
                        onClick={closePopup}
                        className="pl-4 text-2xl text-[#0000009D]"
                    >
                        <RxCross1 />
                    </button>
                </div>
                {books?.map((b) => (
                    <FoundBooks
                        key={b.id}
                        title={b.title}
                        price={b.price}
                        photos={b.photos}
                    />
                ))}
            </div>
        </div>
    )
}

export default SearchPopup

"use client"
import { BsSearch } from "react-icons/bs"
import React, { useState } from "react"
import SearchPopup from "@/components/main/SearchPopup"

const Searchbar = () => {
    const [value, setValue] = useState("")
    const [isPopupOpen, setIsPopupOpen] = useState(false)

    const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault()
    }

    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setValue(e.target.value)
        setIsPopupOpen(true)
    }

    const handleInputFocus = (e: React.FocusEvent<HTMLInputElement>) => {
        if (e.target.value !== "") {
            setIsPopupOpen(true)
        }
    }

    return (
        <>
            <form
                onSubmit={handleSubmit}
                className={"w-fit bg-neutral-100 flex items-center"}
            >
                <button className={"p-4 text-xl"}>
                    <BsSearch />
                </button>
                <input
                    type="text"
                    className="w-96 placeholder:text-[#0000004D] h-14 bg-neutral-100"
                    placeholder="search book..."
                    value={value}
                    onFocus={handleInputFocus}
                    onChange={handleInputChange}
                />
            </form>
            {isPopupOpen ? (
                <SearchPopup inputValue={value} setInputValue={setValue} setIsOpen={setIsPopupOpen} />
            ) : null}
        </>
    )
}

export default Searchbar

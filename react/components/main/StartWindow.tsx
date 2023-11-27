"use client"
import React from "react"
import Searchbar from "@/components/main/SearchBar"

const StartWindow = () => {
    return (
        <section className={"w-4/5 m-auto h-[calc(100vh-110px)]"}>
            <div className={"absolute top-0 right-0 h-full -z-10"}>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="863"
                    height="100%"
                    viewBox="0 0 664 613"
                    preserveAspectRatio="none"
                >
                    <path
                        d="M94.1837 414.532C31.9823 508.827 37.7751 588.038 159.457 613H664.931V0H47.1093C-128.228 169.823 258.575 165.322 94.1837 414.532Z"
                        fill="#FF971D"
                    />
                </svg>
            </div>
            <div className={"flex flex-col gap-6 py-12 "}>
                <h1 className="text-7xl font-bold uppercase">
                    read and add <br /> your insight
                </h1>
                <span className="text-black text-2xl capitalize">
                    find your favorite book
                </span>
                <Searchbar />
            </div>
        </section>
    )
}

export default StartWindow

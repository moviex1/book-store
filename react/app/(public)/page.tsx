import { BsBookmarkDash } from "react-icons/bs"
import ShopItem from "@/components/common/ShopItem"
import React from "react"
import StoreMiniItem from "@/components/common/ShopMiniItem"
import BookPoster from "@/assets/bookPoster.png"
import Image from "next/image"
import Link from "next/link"
import Section from "@/components/main/Section"
import SubSection from "@/components/main/SubSection"
import StartWindow from "@/components/main/StartWindow"
import SliderComponent from "@/components/slider/SliderComponent"
import Navbar from "@/components/nav/Navbar"
import { Book } from "@/types/Book"
import { fetchBooks } from "@/services/books"

export default async function Home() {
    const books: Book[] = await fetchBooks()
    console.log(books)

    return (
        <>
            <StartWindow />
            <section className="bg-[#F5F6F8] flex relative gap-16 py-20">
                <Navbar isOpen={true} />
                <div className={"flex flex-col gap-20 w-[85%]"}>
                    <Section>
                        <SubSection title={"Recommended"}>
                            <div className={"flex flex-wrap gap-20 py-16"}>
                                {books.map((item, idx) => (
                                    <ShopItem
                                        descr={item.description}
                                        votes={item.reviews?.length}
                                        title={item.title}
                                        id={item.id}
                                        src={item.photos[0].url}
                                        authors={item.authors}
                                        key={`home-item-${idx}`}
                                        className="w-2/5 bg-white p-8 rounded-xl grow"
                                    />
                                ))}
                            </div>
                        </SubSection>
                        <SubSection title={"New Arrivals"}>
                            <div className="flex flex-wrap gap-20 justify-between py-16">
                                <StoreMiniItem
                                    id={1}
                                    src={""}
                                    title="all the light we cannot see"
                                    author="anthony doerr"
                                    className={"w-1/5"}
                                />
                                <StoreMiniItem
                                    id={1}
                                    src={""}
                                    title="all the light we cannot see"
                                    author="anthony doerr"
                                    className={"w-1/5"}
                                />
                                <StoreMiniItem
                                    id={1}
                                    src={""}
                                    title="all the light we cannot see"
                                    className={"w-1/5"}
                                    author="anthony doerr"
                                />
                                <StoreMiniItem
                                    id={1}
                                    src={""}
                                    title="all the light we cannot see"
                                    className={"w-1/5"}
                                    author="anthony doerr"
                                />
                            </div>
                        </SubSection>
                    </Section>
                    <Section>
                        <SubSection title={"Book of this week"}>
                            <div className="flex py-20 gap-16 items-center">
                                <div className={"flex flex-col gap-6 w-2/6"}>
                                    <Link href={`/1`}>
                                        <h1 className="text-6xl opacity-80">
                                            Salvation of a Saint
                                        </h1>
                                    </Link>
                                    <span className={"opacity-90"}>
                                        Keigo Higashiro
                                    </span>
                                    <div
                                        className={
                                            "flex justify-between pt-4 w-[90%]"
                                        }
                                    >
                                        <div className={"flex flex-col gap-3"}>
                                            <span className={"opacity-90"}>
                                                Originally published
                                            </span>
                                            <span className={"font-medium"}>
                                                July 11, 1960
                                            </span>
                                        </div>
                                        <div className={"flex flex-col gap-3"}>
                                            <span className={"opacity-90"}>
                                                Publisher
                                            </span>
                                            <span className="capitalize font-medium">
                                                Shin Publishing
                                            </span>
                                        </div>
                                    </div>
                                    <div className={"flex flex-col gap-3 pb-4"}>
                                        <span className={"opacity-90"}>
                                            Categories
                                        </span>
                                        <span
                                            className={"capitalize font-medium"}
                                        >
                                            Fictional, Magical Realism, Asian
                                            Literature, Domestic Fiction
                                        </span>
                                    </div>
                                    <div className="flex gap-3 items-center">
                                        <button
                                            className={"btn p-5 rounded-lg"}
                                        >
                                            <BsBookmarkDash />
                                        </button>
                                        <Link
                                            href={`/1`}
                                            className={
                                                "btn py-4 px-12 rounded-lg"
                                            }
                                        >
                                            Get Book
                                        </Link>
                                    </div>
                                </div>
                                <Image src={BookPoster} alt={""} width={290} />
                                <div className={"flex flex-col gap-4 w-1/4"}>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Purus morbi eleifend
                                        enim, tristique. Lorem ipsum dolor sit
                                        amet, consectetur adipiscing elit. Purus
                                        morbi eleifend enim, tristique
                                    </p>
                                    <div className={"h-1 w-20 bg-amber-500"} />
                                    <span className={"opacity-90"}>
                                        Chicago Tribune
                                    </span>
                                </div>
                            </div>
                        </SubSection>
                        <SubSection title={"Bestsellers"}>
                            <SliderComponent />
                        </SubSection>
                    </Section>
                </div>
            </section>
        </>
    )
}

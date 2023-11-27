import CustomImage from "../common/CustomImage"

interface Props {
    photos: [
        {
            id: number,
            url: string,
        }
    ]
    title: string
    price: string
}

const FoundBooks = ({photos, title, price}: Props) => {
    return <div className="w-full flex justify-between items-center h-20%">
        <div>
            <CustomImage width={150} alt="Book Poster" src={photos[0].url}/>
        </div>
        <div className="flex flex-col">
            <h4 className="font-semibold text-xl">{title}</h4>
            <span>{price}$</span>
            <button className="btn">Add to cart</button>
        </div>
    </div>
}

export default FoundBooks
import { useState } from "react";
import { useGlobalContext } from "../contexts/GlobalContext";
// Icons
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faArrowLeft } from '@fortawesome/free-solid-svg-icons'
import { faArrowRight } from '@fortawesome/free-solid-svg-icons'
import { faMaximize } from '@fortawesome/free-solid-svg-icons'

function ImageSlider({ images, onImageClick }) {
    //Global context variables
    const { baseImgUrl } = useGlobalContext()

    // Sate variable
    const [current, setCurrent] = useState(0);

    const prevSlide = () => {
        setCurrent((prev) => (prev === 0 ? images.length - 1 : prev - 1));
    };

    const nextSlide = () => {
        setCurrent((prev) => (prev === images.length - 1 ? 0 : prev + 1));
    };

    return (
        <div className="slider p-relative">
            <img
                src={`${baseImgUrl}/${images[current].url}`}
                alt={images[current].description || `Slide ${images[current].id}`}
                className="slider-img"
            />
            <button
                className="img-expand-btn"
                onClick={() => onImageClick(`${baseImgUrl}/${images[current].url}`)}
            >
                <FontAwesomeIcon icon={faMaximize} />
            </button>
            <button
                onClick={prevSlide}
                className="prev-slide"
            >
                <FontAwesomeIcon icon={faArrowLeft} />
            </button>
            <button
                onClick={nextSlide}
                className="next-slide"
            >
                <FontAwesomeIcon icon={faArrowRight} />
            </button>

            {/* Slider Navigation */}
            <div className="slider-indicators d-flex justify-center align-center">
                {images.map((_, index) => (
                    <span
                        key={index}
                        className={`indicator ${index === current ? "active" : ""}`}
                        onClick={() => setCurrent(index)}
                    />
                ))}
            </div>
        </div>
    );
};

export default ImageSlider;
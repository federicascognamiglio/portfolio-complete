import { Link } from "react-router-dom"
import { useGlobalContext } from "../contexts/GlobalContext"

function HomePage() {

    // Global context variables
    const { categories } = useGlobalContext()

    return (
        <div className="home-page p-relative text-white">
            <div className="container">
                {/* Background */}
                <div className="lockscreen-logo d-flex flex-column align-center absolute-center">
                    <img className="logo" src="/img/scg-logo-white.png" alt="SCG Logo" />
                    <p className="subtitle text-uppercase">Graphic Designer - Motion Graphics - Content Creator</p>
                </div>
                {/* Folders */}
                <div className="d-flex justify-between">
                    <div className="folders">
                        <div className="row">
                            {categories && categories.map(category => (
                                <div key={category.id} className="col-50">
                                    <div className="folder">
                                        <Link className='d-flex flex-column align-center' to={`/projects?categoryName=${category.name}`}>
                                            <img className='folder-icon' src="/img/folder.webp" alt="Folder Icon" />
                                            <p className="folder-label text-white text-center">{category.name}</p>
                                        </Link>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                    {/* Reel & CV*/}
                    <div className='d-flex flex-column align-center'>
                        <Link to={'/reel'} className="reel folder d-flex flex-column align-center">
                            <img className="reel-icon" src='/img/reel-cover.webp' alt='Reel thumbnail' />
                            <p className='folder-label text-white text-center'>Reel</p>
                        </Link>
                        <Link to={'/cv'} className="cv folder d-flex flex-column align-center">
                            <img className="cv-icon" src='/img/pdf-file-icon.webp' alt='Pdf icon' />
                            <p className='folder-label text-white text-center'>CV</p>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default HomePage
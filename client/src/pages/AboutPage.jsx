import { Link } from "react-router-dom"

function AboutPage() {
    return (
        <div className="about-page text-white">
            <div className="container">
                {/* BreadCrumbs */}
                <div className="bread-crumbs d-flex">
                    <Link to="/" className="bread-crumb-link">Home /</Link>
                    <p className="bread-crumb-active">Reel</p>
                </div>
                {/* Content */}
                <div className="d-flex flex-column align-center">
                    <h1>We're working on this page!</h1>
                    <p>We're sorry for the incovenience, this page will soon be available.</p>
                </div>
            </div>
        </div>
    )
}

export default AboutPage
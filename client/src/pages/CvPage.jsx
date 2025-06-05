import { Link } from "react-router-dom"

function CvPage() {
    return (
        <div className="cv-page text-white">
            <div className="container">
                {/* BreadCrumbs */}
                <div className="bread-crumbs d-flex">
                    <Link to="/" className="bread-crumb-link">Home /</Link>
                    <p className="bread-crumb-active">Reel</p>
                </div>
                {/* Content */}
                <div className="d-flex flex-column align-center">
                    <h1>We're working on this page!</h1>
                    <p>This page will soon be available. Meanwhile you can download my CV at this link:</p>
                    <a href="/files/CV_Fede.pdf" download="CV-FedericaScognamiglio.pdf" className="btn-link text-uppercase text-center rounded">Download CV</a>
                </div>
            </div>
        </div>
    )
}

export default CvPage
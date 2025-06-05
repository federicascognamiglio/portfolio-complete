function AppFooter() {
    return (
        <footer className="footer d-flex align-center">
            <ul className="links d-flex align-center">
                <li className="footer-link p-relative">
                    <div className="hover-link-label text-center d-none text-white rounded">Behance</div>
                    <a href={import.meta.env.VITE_BEHANCE_LINK} target="_blank">
                        <img className="link-icon" src="/img/behance-logo.webp" alt="Behance Logo" />
                    </a>
                </li>
                <li className="footer-link p-relative">
                    <div className="hover-link-label text-center d-none text-white rounded">LinkedIn</div>
                    <a href={import.meta.env.VITE_LINKEDIN_LINK} target="_blank">
                        <img className="link-icon" src="/img/linkedin-logo.webp" alt="Linkedin Logo" style={{ backgroundColor: '#ffffff' }} />
                    </a>
                </li>
                <li className="footer-link p-relative">
                    <div className="hover-link-label text-center d-none text-white rounded">Mail</div>
                    <a href={import.meta.env.VITE_MAIL_LINK} target="_blank">
                        <img className="link-icon" src="/img/mail-logo.webp" alt="Mail Logo" />
                    </a>
                </li>
                <li className="footer-link p-relative">
                    <div className="hover-link-label text-center d-none text-white rounded">Phone</div>
                    <a href={import.meta.env.VITE_PHONE_LINK} target="_blank">
                        <img className="link-icon" src="/img/phone-logo.webp" alt="Phone Logo" />
                    </a>
                </li>
                <li className="footer-link p-relative">
                    <div className="hover-link-label text-center d-none text-white rounded">GitHub</div>
                    <a href={import.meta.env.VITE_GITHUB_LINK} target="_blank">
                        <img className="link-icon" src="/img/github-logo.webp" alt="Github Logo" />
                    </a>
                </li>
                <li className="footer-link p-relative">
                    <div className="hover-link-label text-center d-none text-white rounded">Instagram</div>
                    <a href={import.meta.env.VITE_INSTAGRAM_LINK} target="_blank">
                        <img className="link-icon" src="/img/instagram-logo.webp" alt="Instagram Logo" />
                    </a>
                </li>
                <li className="footer-link p-relative">
                    <div className="hover-link-label text-center d-none text-white rounded">TikTok</div>
                    <a href={import.meta.env.VITE_TIKTOK_LINK} target="_blank">
                        <img className="link-icon" src="/img/tiktok-logo.webp" alt="TikTok Logo" />
                    </a>
                </li>
                <li className="footer-link p-relative">
                    <div className="hover-link-label text-center d-none text-white rounded">Trash</div>
                    <img className="link-icon" src="/img/bin-logo.webp" alt="Trash Icon" />
                </li>
            </ul>
        </footer>
    )
}

export default AppFooter
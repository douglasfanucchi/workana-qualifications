export default function QualificationItem(props) {
    const { qualification } = props

    return(
        <li className="qualifications-list__item">
            <span className="item__avatar">
                <figure>
                    <img src={qualification.clientAvatar} />
                </figure>
            </span>
            <span className="item__name">{qualification.clientName}</span>
            <p className="item__message">{qualification.text}</p>
        </li>
    )
}

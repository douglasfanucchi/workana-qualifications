import QualificationList from './components/qualifications-list/index.js'

export default function Entry({attributes}) {
    const { qualifications } = attributes
    const { title } = attributes

    return(
        <div className="container wp-block">
            <h1 className="title">{title}</h1>
            <QualificationList qualifications={qualifications} />
        </div>
    )
}

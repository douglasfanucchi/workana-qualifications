import QualificationList from './components/qualifications-list/index.js'

export default function Entry({attributes: {qualifications}}) {
    return(
        <QualificationList qualifications={qualifications} />
    )
}

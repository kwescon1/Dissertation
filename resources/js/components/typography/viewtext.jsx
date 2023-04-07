const ViewText = ({ label, data, name }) => {
    return (
        <div className="block ">
            <label htmlFor={name} className="font-semibold ">
                {label}
            </label>
            <div name={name}>{data}</div>
        </div>
    );
};

export const ViewMutiText = ({ label, dataInfo }) => {
    return (
        <div className="block ">
            <label className="font-semibold ">
                {label}
            </label>
            <ul>
                {dataInfo.map((data, index) => (
                    <li key={index}>
                        <div className="block">{data.name}</div>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default ViewText;

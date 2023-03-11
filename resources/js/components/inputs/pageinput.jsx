const PageInput = ({ label, type, placeholder, name, id }) => {
  return ( 
    <div>
      <div className="block space-y-1 ">
            <label htmlFor={name} className="font-semibold ">{label}</label>
            <input
                className="form-input rounded border-gray-400 w-full"
                type={type}
                placeholder={placeholder}
                name={name}
                id={id}
            />
        </div>
    </div>
   );
}

export const PageSelectInput = ({label, name, id, options}) => {
  return ( 
    <div className="block space-y-1">
      <label htmlFor={name} className="font-semibold ">{label}</label>
      <select className="form-input rounded border-gray-400 w-full" name={name}  id={id}>
        {options.map((option, index)  => (
          <option key={index} className="py-2" value={option.value}>{option.name}</option>
        ) )

        }
        
      </select>
    
    </div>
   );
}

export const RadioInput = ({name, id, label, value, onChange, checked}) => {
  return (
    <div className="flex items-center space-x-2">
      <input
                className=" border-gray-400  "
                type="radio"
                name={name}
                id={id}
                value ={value}
                onChange = {onChange}
                checked={checked}
            />
      <label htmlFor={id} className="font-medium">{label}</label>

    </div>
  )
}
 
export default PageInput;
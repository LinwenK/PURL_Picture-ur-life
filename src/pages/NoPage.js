import vidsrc from '../img/error.mp4'

function NoPage(){
  return(
    <div id='error'>
      <video autoPlay loop muted className='v-error'>
        <source src={vidsrc} type='video/mp4'/>
      </video>
    </div>
  )
}
export default NoPage;
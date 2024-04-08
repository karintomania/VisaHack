export function toggleDetail(id){
  const detail_id =  'job_detail_'+id;
  const detail = document.getElementById(detail_id);
  detail.classList.toggle('hidden');
  
  const summary_id =  'job_summary_'+id;
  const summary = document.getElementById(summary_id);
  summary.classList.toggle('hidden');
}

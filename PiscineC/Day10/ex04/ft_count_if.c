/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_count_if.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/09 16:59:00 by jmondino          #+#    #+#             */
/*   Updated: 2018/11/09 16:59:02 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */


int		ft_count_if(char **tab, int (*f)(char*))
{
	int count;
	int i;

	count = 0;
	index = 0;
	while (tab[i])
	{
		if (f(tab[i]))
			count++;
		i++;
	}
	return (count);
}

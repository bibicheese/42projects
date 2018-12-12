/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_is_sort.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/20 23:48:31 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/22 18:34:06 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

int		ft_is_sort(int *tab, int length, int (*f)(int, int))
{
	int i;
	int crois;
	int decrois;

	i = 0;
	crois = 1;
	decrois = 1;
	while (i + 1 < length)
	{
		if (!(f(tab[i], tab[i + 1]) > 0))
			crois = 0;
		i++;
	}
	i = 0;
	while (i + 1 < length)
	{
		if (!(f(tab[i], tab[i + 1]) < 0))
			decrois = 0;
		i++;
	}
	return (crois || decrois);
}

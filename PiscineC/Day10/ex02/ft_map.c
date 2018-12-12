/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_map.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/20 18:10:31 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/22 23:18:32 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <stdlib.h>

int	*ft_map(int *tab, int length, int (*f)(int))
{
	int *taboc;
	int i;

	if ((taboc = (int*)malloc(sizeof(*taboc) * (length))) == NULL)
		return (0);
	i = 0;
	while (i < length)
	{
		taboc[i] = f(tab[i]);
		i++;
	}
	taboc[i] = '\0';
	return (taboc);
}

/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_iterative_factorial.c                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: mondino <jmondino@student.42.fr>           +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/07 16:02:35 by mondino           #+#    #+#             */
/*   Updated: 2018/11/07 17:45:17 by mondino          ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

int		ft_iterative_factorial(int nb)
{
	int nb2;

	nb2 = 1;
	if (nb < 0 || nb > 12)
		return (0);
	if (nb >= 0 && nb < 2)
		return (1);
	else
	{
		while (nb > 1)
		{
			nb2 *= nb;
			nb--;
		}
	}
	return (nb2);
}
